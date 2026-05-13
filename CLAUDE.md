# CLAUDE.md — Dự án XOSO (Xô Số)

## Tổng quan

**Tên dự án:** Xoso.com  
**Domain:** https://xoso.com/  
**Mục đích:** Nền tảng xổ số Việt Nam — cung cấp kết quả xổ số trực tiếp, thống kê, soi cầu, vé số trực tuyến và cộng đồng người chơi.  
**Thư mục gốc:** `public_html/`

---

## Công nghệ sử dụng

### Backend
- **Ngôn ngữ:** PHP
- **Framework:** CodeIgniter 2.0 (legacy MVC, kiến trúc HMVC modular)
- **Cơ sở dữ liệu:** MySQL — database name: `xosov2`, user: `xoso`, host: `localhost`
- **Web server:** Apache + mod_rewrite (URL routing qua `.htaccess`)
- **Template engine:** Smarty
- **PDF:** TCPDF (trong `application/3rdparty/tcpdf/`)
- **HTML parsing:** `simple_html_dom.php` (dùng cho web scraping)
- **HTTP client:** cURL (thư mục `curl/`)
- **Device detection:** Mobile_Detect library
- **Encryption:** Custom encryption library (`application/libraries/encryption.php`)
- **Payment:** BH_Payment (`application/libraries/BH_Payment.php`)
- **Captcha:** Custom captcha image generation

### Frontend
- **JavaScript:** jQuery UI 1.12.1
- **Icons:** Font Awesome 4.7.0
- **CSS:** Custom stylesheet (`public/client/assets/css/style.css`)
- **HTML DOM:** `simple_html_dom.php`

### Tích hợp dịch vụ
- **SMS:** Module SMS tích hợp (`sms/`)
- **Chat:** Hệ thống chat người dùng (`chat/`)
- **Payment:** BH_Payment xử lý thanh toán

---

## Kiến trúc thư mục

```
public_html/
├── index.php                    # Front controller chính
├── function.php                 # Global helper functions
├── cron.php                     # Background job scheduler
├── .htaccess                    # Apache URL rewrite rules
├── PHP.INI                      # PHP configuration
├── robots.txt                   # SEO/crawling rules
├── sitemap.xml / sitemap.html   # SEO sitemaps
│
├── application/                 # Core CodeIgniter application
│   ├── config/                  # Cấu hình ứng dụng
│   │   ├── config.php           # Base URL, charset UTF-8, URI protocol
│   │   ├── database.php         # Kết nối MySQL
│   │   ├── routes.php           # URL routing (default: client/home, 404: client/error_404)
│   │   ├── constants.php        # Hằng số ứng dụng
│   │   ├── autoload.php         # Auto-load libraries/models
│   │   ├── hooks.php            # Event hooks
│   │   └── tcpdf.php            # PDF config
│   │
│   ├── modules/                 # HMVC Modules
│   │   ├── client/              # Website người dùng (frontend)
│   │   │   ├── controllers/     # Pages, news, results, user login
│   │   │   ├── models/          # Data models của module
│   │   │   └── views/           # Templates (15+ trang)
│   │   ├── admin/               # Trang quản trị (/acp_admin)
│   │   ├── app/                 # API/Backend services
│   │   ├── mobile/              # Hỗ trợ mobile app
│   │   └── language/            # Localization (Tiếng Việt)
│   │
│   ├── models/                  # Global data models (30+ files)
│   │   ├── xs_result_model.php          # Kết quả xổ số
│   │   ├── xs_location_model.php        # Dữ liệu vùng/tỉnh
│   │   ├── xs_northern_model.php        # Xổ số Miền Bắc
│   │   ├── xs_central_model.php         # Xổ số Miền Trung
│   │   ├── xs_southern_model.php        # Xổ số Miền Nam
│   │   ├── user_model.php               # Tài khoản người dùng
│   │   ├── xs_loto_online_model.php     # Vé số trực tuyến
│   │   ├── banner_model.php             # Quảng cáo/banner
│   │   ├── news_model.php               # Tin tức
│   │   ├── menu_model.php               # Điều hướng site
│   │   ├── contact_model.php            # Trang liên hệ
│   │   └── gioithieu_model.php          # Trang giới thiệu
│   │
│   ├── libraries/               # Reusable components (17 files)
│   │   ├── BH_Payment.php       # Xử lý thanh toán
│   │   ├── Smarty.php           # Template engine
│   │   ├── Mobile_Detect.php    # Phát hiện thiết bị
│   │   ├── encryption.php       # Mã hóa dữ liệu
│   │   ├── pdf.php              # Xuất PDF
│   │   └── simple_html_dom.php  # HTML DOM parsing
│   │
│   ├── 3rdparty/                # External libraries
│   │   └── tcpdf/               # PDF generation
│   │
│   ├── helpers/                 # Helper functions
│   ├── hooks/                   # CodeIgniter hooks
│   ├── errors/                  # Error pages (404, DB, PHP)
│   ├── views/                   # Global views
│   ├── cache/                   # Query caching
│   └── logs/                    # Error logs
│
├── system/                      # CodeIgniter 2.0 framework core
│   ├── core/                    # Core classes
│   ├── database/                # MySQL driver
│   ├── helpers/                 # Built-in helpers
│   └── libraries/               # Built-in libraries
│
├── public/                      # Frontend static assets
│   └── client/assets/
│       ├── css/                 # style.css (custom)
│       ├── js/                  # function.js, jQuery UI
│       ├── images/              # UI images
│       ├── font-awesome-4.7.0/  # Icon font
│       └── jquery-ui-1.12.1.custom/  # jQuery UI
│
├── xoso_mobile/                 # Phiên bản mobile (tách biệt)
│   ├── application/             # Mobile app logic
│   └── public/client/assets/    # Mobile assets
│
├── live/                        # Kết quả xổ số trực tiếp (live stream)
├── feed/                        # RSS/data feeds
├── curl/                        # cURL utilities (web scraping)
├── chat/                        # Hệ thống chat
├── sms/                         # SMS integration
├── lib/                         # Additional libraries
└── images/                      # Image assets
```

---

## Tính năng chính

1. **Kết quả xổ số trực tiếp** — 3 miền: Miền Bắc, Miền Trung, Miền Nam
2. **Thống kê & phân tích** — Soi cầu, dự đoán số, loto
3. **Vé số trực tuyến** — Đặt vé online (`xs_loto_online_model`)
4. **Tin tức xổ số** — Bài viết, thông tin liên quan
5. **Tài khoản người dùng** — Đăng ký, đăng nhập, VIP membership
6. **Chat cộng đồng** — Trao đổi giữa người chơi
7. **Admin panel** — Quản trị tại `/acp_admin`
8. **Mobile version** — Phiên bản riêng tại `xoso_mobile/`
9. **Cron jobs** — Tác vụ nền định kỳ (`cron.php`)

---

## Entry Points quan trọng

| URL | Mô tả |
|-----|-------|
| `/` | Trang chủ → controller `client/home` |
| `/index.php` | Front controller CodeIgniter |
| `/live-xoso.html` | Kết quả trực tiếp |
| `/dang-nhap.html` | Đăng nhập người dùng |
| `/acp_admin` | Admin panel |
| `cron.php` | Background jobs |

### AJAX Endpoints (trong `client/home.php`)
- `xstt` — Thống kê xổ số
- `loadkqxs` — Load kết quả xổ số
- `getkqxs` — Lấy kết quả xổ số
- `betlist` — Danh sách cược

---

## Lưu ý kỹ thuật

- **CodeIgniter 2.0 là legacy** — ra mắt 2011, không còn được hỗ trợ chính thức
- **Không có Composer hay npm** — quản lý thư viện thủ công, không có `composer.json` hay `package.json`
- **HMVC pattern** — dùng modules thay vì CI thuần để dễ mở rộng
- **Database prefix:** `xs_` cho các bảng xổ số
- **Charset:** UTF-8
- **URL protocol:** `REQUEST_URI`
- **Caching:** Query cache tại `application/cache/`
- **Device routing:** Mobile_Detect tự động redirect người dùng mobile sang `xoso_mobile/`
