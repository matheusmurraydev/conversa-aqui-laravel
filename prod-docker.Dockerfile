# Use the laravelphp/vapor image as the base image
FROM laravelphp/vapor:php82

# Install necessary system dependencies (if supported by the base image)
# For this example, we assume the base image supports apk package manager
RUN apk update && \
    apk add --no-cache imagemagick-dev && \
    rm -rf /var/cache/apk/*

# Install the Imagick extension using pecl
RUN pecl install imagick && \
    docker-php-ext-enable imagick

COPY ./php.ini /usr/local/etc/php/conf.d/overrides.ini

# Copy your Laravel application code into the container
COPY . /var/task
