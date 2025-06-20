<?php
//done
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stok = $_POST['stok'];
    $type = $_POST['type'];
	$size = $_POST['size'];

    $conn = new mysqli('localhost', 'root', '', 'ecom_db');

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
                        $messageType = "success"; 
                    } else {
                        $message = "Error inserting product into database.";
                        $messageType = "error"; 
                    }
                    $stmt->close();
                } else {
                    $message = "Error uploading the image.";
                    $messageType = "error";
                }
            } else {
                $message = "Image size should be less than 5MB.";
                $messageType = "error"; 
            }
        } else {
            $message = "Invalid image type. Only jpg, jpeg, png, gif are allowed.";
            $messageType = "error"; 
        }
    } else {
        $message = "No image uploaded.";
        $messageType = "error";
    }

    $conn->close();
}
?>                 <h1 class="show">Add Your Product</h1>
                <form action="product.php?page=admin_add_products" method="POST" enctype="multipart/form-data">
                        <div >
                            <p>Name:</p>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div >
                            <p>Description:</p>
                            <textarea id="description" name="description" required></textarea>
                        </div>

                        <div >
                            <p>Price:</p>
                            <input type="text" id="price" name="price" step="0.01" required>
                        </div>

                        <div >
                            <p>Pick Image:</p>
                            <p id="file-name">No file selected</p>
                            <input type="file" id="image" name="image" accept="image/*" required>

                        </div>

                        <div >
                            <br>
                            <p>Stock:</p>
                            <input type="number" id="stock" name="stok" required>
                        </div>
                 
				     <div >
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
	 <div >
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
                </form>
