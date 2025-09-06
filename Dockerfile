# Use official PHP with Apache
FROM php:8.2-apache

# Install common PHP extensions (you can add more if needed)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite (optional, useful for clean URLs)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy your project files into the container
COPY . /var/www/html

# Expose port 80 for web traffic
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
