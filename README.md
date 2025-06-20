# Cilt Bakım Ürünleri Mağazası

Bu proje, kullanıcıların cilt bakım ürünlerini satın alabileceği basit bir e-ticaret mağazasıdır. Proje PHP ve MySQL kullanılarak geliştirilmiştir ve çalıştırmak için XAMPP gereklidir.

## Kurulum

1. XAMPP programını bilgisayarınıza indirin ve kurun: https://www.apachefriends.org/tr/index.html  
2. XAMPP kontrol panelini açın ve Apache ile MySQL servislerini başlatın.  
3. Proje dosyalarını `htdocs` klasörünün içine kopyalayın (örneğin: `C:\xampp\htdocs\cilt-bakim`).  
4. phpMyAdmin üzerinden yeni bir veritabanı oluşturun (örneğin: `cilt_bakim`).  
5. Proje klasöründeki SQL dosyasını (örneğin `database.sql`) phpMyAdmin ile içe aktarın.  
6. Projedeki `config.php` dosyasını açarak veritabanı bağlantı bilgilerini güncelleyin:  
   ```php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "cilt_bakim";
