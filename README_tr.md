<p align="center">
  <img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="Lisans">
  <img src="https://img.shields.io/badge/Laravel-11.x-red.svg" alt="Laravel">
  <img src="https://img.shields.io/badge/Livewire-3.x-pink.svg" alt="Livewire">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-06B6D4.svg" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4.svg" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1.svg" alt="MySQL">
  <img src="https://img.shields.io/badge/Docker-hazır-2496ED.svg" alt="Docker">
</p>

# Open Invoice Manager

Freelancerlar ve küçük işletmeler için ücretsiz, açık kaynak fatura ve teklif yönetimi uygulaması. Laravel ile geliştirilmiştir.

**Depo:** [github.com/mchtylmz/open-invoice-manager](https://github.com/mchtylmz/open-invoice-manager)

**Yazar:** [LinkedIn](https://www.linkedin.com/in/mmucahityilmazz/)

## Özellikler

- Müşteri yönetimi (CRUD)
- Ürün/hizmet kataloğu
- PDF dışa aktarmalı teklif oluşturma
- PDF dışa aktarmalı fatura oluşturma
- Vergi/KDV ayarları
- Çoklu para birimi desteği
- Ödeme durumu takibi
- Şirket profili ayarları
- İstatistiklerle gösterge paneli
- Arama ve filtreleme
- Docker desteği
- Demo veri ekleyici

## Teknoloji Yığını

- **Laravel** (en son kararlı sürüm)
- **Livewire**
- **TailwindCSS**
- **MySQL / MariaDB**
- **Redis**
- **DomPDF**

## Kurulum

### Docker (Önerilen)

```bash
docker-compose up -d
docker-compose exec app php artisan migrate --seed
```

http://localhost:8080 adresinden erişin.

### Manuel Kurulum

```bash
cp .env.example .env
# .env dosyasını veritabanı bilgilerinizle düzenleyin
composer install
npm install && npm run build
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### Demo Giriş Bilgileri

- **E-posta:** admin@example.com
- **Şifre:** password

## Ekran Görüntüleri

| Gösterge Paneli | Müşteriler |
|:--------------:|:----------:|
| ![Gösterge Paneli](docs/screenshots/dashboard.svg) | ![Müşteriler](docs/screenshots/customers.svg) |

| Faturalar | Fatura Detayı |
|:---------:|:-------------:|
| ![Faturalar](docs/screenshots/invoices.svg) | ![Fatura Detayı](docs/screenshots/invoice-detail.svg) |

| Fatura PDF | Ayarlar |
|:----------:|:-------:|
| ![Fatura PDF](docs/screenshots/invoice-pdf.svg) | ![Ayarlar](docs/screenshots/settings.svg) |

## PDF Dışa Aktarma

Faturalar ve teklifler, detay sayfalarından PDF olarak dışa aktarılabilir. Dışa aktarma işlemi DomPDF kullanır ve yazdırmaya uygun düzenler üretir.

## Lisans

MIT
