# استخدم PHP + Apache لتشغيل Laravel
FROM php:8.2-apache

# تثبيت التبعيات المطلوبة
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# ضبط مجلد العمل
WORKDIR /var/www/html

# نسخ كل ملفات المشروع
COPY . .

# تعيين صلاحيات التخزين والتخزين المؤقت
RUN chmod -R 777 storage bootstrap/cache

# تفعيل Rewrite في Apache (مهم للـ routes)
RUN a2enmod rewrite
RUN echo '<Directory /var/www/html>\n\
    AllowOverride All\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# فتح المنفذ
EXPOSE 80

# أمر التشغيل
CMD ["apache2-foreground"]
