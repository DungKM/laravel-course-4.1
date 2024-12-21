# Laravel Basic Commands

## 1. Cài đặt Laravel
### Yêu cầu:
- PHP >= 8.1
- Composer
- MySQL hoặc cơ sở dữ liệu tương thích
- Web server (Apache/Nginx)

### Cài đặt Laravel qua Composer
```bash
composer create-project --prefer-dist laravel/laravel my-project
```
> Thay thế `my-project` bằng tên thư mục bạn muốn sử dụng.

## 2. Cấu hình môi trường
### Tạo file `.env`
Nếu file `.env` chưa tồn tại:
```bash
cp .env.example .env
```

### Tạo khóa ứng dụng
```bash
php artisan key:generate
```

## 3. Thiết lập cơ sở dữ liệu
- Mở file `.env` và cập nhật thông tin kết nối cơ sở dữ liệu:
  ```
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=your_database_name
  DB_USERNAME=your_username
  DB_PASSWORD=your_password
  ```

- Chạy lệnh migration để tạo các bảng cơ sở dữ liệu:
  ```bash
  php artisan migrate
  ```

## 4. Chạy server cục bộ
Khởi chạy server Laravel:
```bash
php artisan serve
```
Server sẽ chạy tại địa chỉ: `http://127.0.0.1:8000`

## 5. Quản lý package
Cài đặt package mới qua Composer:
```bash
composer require package-name
```

Cập nhật các package:
```bash
composer update
```

## 6. Xây dựng tài sản tĩnh (Assets)
Nếu sử dụng Laravel Mix hoặc Vite:
- Cài đặt Node.js:
  ```bash
  npm install
  ```

- Xây dựng assets:
  ```bash
  npm run dev
  ```
  hoặc:
  ```bash
  npm run build
  ```

## 7. Debugging và cache
### Xóa cache ứng dụng
```bash
php artisan cache:clear
```

### Xóa cache cấu hình
```bash
php artisan config:clear
```

### Xóa cache route
```bash
php artisan route:clear
```

## 8. Kiểm tra phiên bản Laravel
```bash
php artisan --version
```

## 9. Các lệnh Artisan hữu ích khác
- Hiển thị danh sách tất cả các lệnh Artisan:
  ```bash
  php artisan list
  ```

- Tạo một controller:
  ```bash
  php artisan make:controller ControllerName
  ```

- Tạo một model:
  ```bash
  php artisan make:model ModelName
  ```

- Tạo một migration:
  ```bash
  php artisan make:migration create_table_name_table
  ```

## 10. Factory và Seeder
### Tạo Factory
- Tạo một factory mới:
  ```bash
  php artisan make:factory FactoryName --model=ModelName
  ```
  > Thay `FactoryName` bằng tên factory và `ModelName` bằng tên model mà bạn muốn liên kết.

### Tạo Seeder
- Tạo một seeder mới:
  ```bash
  php artisan make:seeder SeederName
  ```

### Chạy Seeder
- Chạy một seeder cụ thể:
  ```bash
  php artisan db:seed --class=SeederName
  ```

- Chạy tất cả các seeder:
  ```bash
  php artisan db:seed
  ```

### Sử dụng Factory trong Seeder
Trong file seeder, bạn có thể sử dụng factory để tạo dữ liệu giả lập:
```php
\App\Models\ModelName::factory()->count(10)->create();
```

## 11. Tài liệu tham khảo
- [Laravel Official Documentation](https://laravel.com/docs)
- [Laravel UI](https://github.com/laravel/ui)
- [Spatie](https://github.com/laravel/ui](https://spatie.be/docs/laravel-permission/v5/introduction))
- [Password-hash](https://onlinephp.io/password-hash)
