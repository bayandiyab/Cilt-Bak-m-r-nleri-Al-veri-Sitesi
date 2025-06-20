<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stok = $_POST['stok'];
    $type = $_POST['type'];
	$size = $_POST['size'];
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $imageSize = $image['size'];
        $imageError = $image['error'];

        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedExts = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($imageExt, $allowedExts)) {
            if ($imageSize <= 5000000) {
                $newImageName = uniqid('', true) . '.' . $imageExt;
                #$uploadPath = 'uploads/' . $newImageName;
				// Map product type to specific upload folder
				switch ($type) {
					case 'Background':
						$uploadPath = 'assets/background/'. $newImageName;
						break;
					case 'Body':
						$uploadPath = 'assets/body/'. $newImageName;
						break;
					case 'Cleanser':
						$uploadPath = 'assets/cleanser/'. $newImageName;
						break;
					case 'Set':
						$uploadPath = 'assets/set/'. $newImageName;
						break;
					case 'Serum':
						$uploadPath = 'assets/serum/'. $newImageName;
						break;
					case 'Sun':
						$uploadPath = 'assets/sun_cream/'. $newImageName;
						break;
					default:
						$uploadPath = 'assets. $newImageName;'; // fallback just in case
						break;
				}
                if (move_uploaded_file($imageTmpName, $uploadPath)) {
                    $sql = "INSERT INTO products_tb (name, description, price, stok, image, type, size) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
					$stmt->bind_param("ssdisss", $name, $description, $price, $stok, $uploadPath, $type,$size);

                    if ($stmt->execute()) {
                        $message = "Product added successfully!";
                        $messageType = "success"; // نوع الرسالة
                    } else {
                        $message = "Error inserting product into database.";
                        $messageType = "error"; // نوع الرسالة
                    }
                    $stmt->close();
                } else {
                    $message = "Error uploading the image.";
                    $messageType = "error"; // نوع الرسالة
                }
            } else {
                $message = "Image size should be less than 5MB.";
                $messageType = "error"; // نوع الرسالة
            }
        } else {
            $message = "Invalid image type. Only jpg, jpeg, png, gif are allowed.";
            $messageType = "error"; // نوع الرسالة
        }
    } else {
        $message = "No image uploaded.";
        $messageType = "error"; // نوع الرسالة
    }

    // إغلاق الاتصال
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Work+Sans:wght@300;400;700;900&display=swap">
    <style>
        * {
            outline-width: 0;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: rgb(255, 240, 245);
            /* لون خلفية هادئ من الوردي الفاتح */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
            margin: 0;
        }

        #container {
            height: 100vh;
            width: 100%;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #inviteContainer {
            position: relative;
            display: flex;
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
            box-shadow: 0px 6px 30px rgba(255, 105, 180, 0.3);
            /* ظل وردي */
            background: rgba(255, 182, 193, 0.8);
            /* خلفية وردية */
        }

        .logoContainer {
            position: relative;
            width: 100%;
            padding: 30px 35px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .logoContainer.show {
            opacity: 1;
            transform: scale(1);
        }

        .logoContainer h1 {
            color: #FF66B2;
            /* لون وردي قوي */
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 10px;
            text-align: center;
            opacity: 0;
            transition: opacity 0.8s ease;
        }

        .logoContainer h1.show {
            opacity: 1;
        }

        .acceptContainer {
            width: 100%;
            padding: 45px 5px;
            box-sizing: border-box;
            height: 0;
            opacity: 0;
            overflow: hidden;
            transition: height 0.5s ease, opacity 0.5s ease;
        }

        .acceptContainer.show {
            height: 650px;
            opacity: 1;
        }

        form {
            width: 100%;
            text-align: center;
        }

        .formContainer {
            text-align: left;
        }

        .formDiv {
            margin-bottom: 10px;
            opacity: 0;
            transition: opacity 0.5s ease, left 0.5s ease;
            position: relative;
            left: -25px;
        }

        .formDiv.show {
            opacity: 1;
            left: 0;
        }

        p {
            color: #FF66B2;
            /* اللون الوردي */
            font-weight: 600;
            font-size: 20px;
            margin: 0;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 5px;
            margin-top: 20px;
            border: none;
            background: transparent;
            box-shadow: inset 0 -1px 0 rgba(255, 105, 180, 0.15);
            /* ظل خفيف بلون وردي */
            color: #FF66B2;
            /* نص بلون وردي */
            font-size: 20px;
            transition: box-shadow 0.3s ease;
        }

        input:focus,
        textarea:focus {
            box-shadow: inset 0 -2px 0 #FF66B2;
            /* ظل وردي عند التركيز */
        }

        button {
            width: 100%;
            padding: 18px;
            margin-top: 25px;
            background: linear-gradient(45deg, #FF66B2, #FF3385);
            /* تدرج من الوردي الفاتح إلى الداكن */
            border: none;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(45deg, #FF3385, #FF66B2);
            /* تدرج مع تأثير hover */
        }

        .message {
            font-size: 18px;
            margin-bottom: 20px;
            background-color: #28a745;
            /* اللون الأخضر */
            color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 10px 30px 0 rgba(9, 105, 153, 0.4);
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            animation: slideDown 0.5s ease-in-out;
        }

        @keyframes slideDown {
            from {
                top: -50px;
            }

            to {
                top: 20px;
            }
        }

        .message.success {
            background-color: #28a745;
            color: white;
        }

        .message.error {
            background-color: #dc3545;
            color: white;
        
        }
		.button-bar {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    gap: 10px;
}
.button-bar button {
    padding: 10px 20px;
    font-weight: bold;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    background-color: #007bff;
    color: white;
}
    </style>

</head>

<body>
    <?php if (isset($message)): ?>
        <div class="message <?= $messageType; ?>">
            <?= $message; ?>
        </div>
    <?php endif; ?>


<?php
$conn = new mysqli('localhost', 'root', '', 'ecom_db');
$sql = "SELECT * FROM users_tb ORDER BY id";
$result = $conn->query($sql);
$sql2 = "SELECT * FROM products_tb";
$result2 = $conn->query($sql2);
?>
  <div id="container">
<div id="inviteContainer">
<div class="logoContainer">
                <h1 class="show">Members</h1>
            </div>
<table>
<tr><th>Name</th><th>Registration time</th><th>Email</th><th>Credit owner name</th><th>Credit number</th></tr>
<?php while ($user = $result->fetch_assoc()): ?>
<tr>
<td><?= $user['registration_nickname'] ?></td>
<td><?= $user['registration_time'] ?></td>
<td><?= $user['email'] ?></td>
<td><?= $user['credit_owner'] ?></td>
<td><?= $user['credit_number'] ?></td>
</tr>
<?php endwhile; ?>
</table>
</div>
	
	
        <div id="inviteContainer" >
            <div class="logoContainer">
                <h1 class="show">Add Your Product</h1>
            </div>

            <div class="acceptContainer">
                <form action="product.php" method="POST" enctype="multipart/form-data">
                    <div class="formContainer">
                        <div class="formDiv">
                            <p>Name:</p>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="formDiv">
                            <p>Description:</p>
                            <textarea id="description" name="description" required></textarea>
                        </div>

                        <div class="formDiv">
                            <p>Price:</p>
                            <input type="text" id="price" name="price" step="0.01" required>
                        </div>

                        <div class="formDiv">
                            <p>Pick Image:</p>
                            <p id="file-name">No file selected</p>
                            <input type="file" id="image" name="image" accept="image/*" required>

                        </div>

                        <div class="formDiv">
                            <br>
                            <p>Stock:</p>
                            <input type="number" id="stock" name="stok" required>
                        </div>
                 
				     <div class="formDiv">
        <p>Product Type:</p>
        <select name="type" id="type" required>
            <option value="">-- Select Type --</option>
            <option value="Background">Background image</option>
            <option value="Body">Body</option>
            <option value="Cleanser">Cleanser</option>
            <option value="Set">Set</option>
            <option value="Serum">Serum</option>
            <option value="Sun">Sun cream</option>
        </select>
    </div>
	 <div class="formDiv">
        <p>Size:</p>
        <select name="size" id="size" required>
            <option value="">-- Select Type --</option>
            <option value="100">100</option>
            <option value="150">150</option>
            <option value="200">200</option>
            <option value="250">250</option>
        </select>
    </div>	
                        <button type="submit">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
	
	
	
	function showSection(id) {
    const sections = ['add-product', 'view-users', 'warehouse-products'];
    sections.forEach(sec => {
        const el = document.getElementById(sec);
        if (el) el.style.display = (sec === id) ? 'block' : 'none';
    });
}
        window.onload = function() {
            setTimeout(function() {
                document.querySelector('.logoContainer').classList.add('show');
                setTimeout(function() {
                    document.querySelector('.acceptContainer').classList.add('show');
                    setTimeout(function() {
                        var formDivs = document.querySelectorAll('.formDiv');
                        formDivs.forEach((div, index) => {
                            setTimeout(function() {
                                div.classList.add('show');
                            }, 500 * index);
                        });
                    }, 500);
                }, 500);
            }, 10);

            // إذا كانت هناك رسالة، نقوم بتفعيل الاختفاء بعد 3 ثواني
            var message = document.querySelector('.message');
            if (message) {
                setTimeout(function() {
                    message.style.display = 'none';
                }, 3000); // 3 ثواني لاخفاء الرسالة
            }
        };
    </script>
</body>

</html>