ARG UID=1000
ARG GID=1000
ARG PHP_VERSION=8.2-cli
ARG NODE_VERSION=22.0.0
ARG COMPOSER_VER=2.4
ARG PHP_EXT_INSTALLER_VER=2.1.72
ARG PHP_EXT="opcache mcrypt bcmath pdo_mysql pcntl imagick gd soap zip calendar igbinary apcu redis exif"

FROM composer:${COMPOSER_VER} as composer

FROM mlocati/php-extension-installer:${PHP_EXT_INSTALLER_VER} as php-extension-installer

FROM php:${PHP_VERSION} as php_cli
COPY --from=composer --link /usr/bin/composer /usr/local/bin/composer
COPY --from=php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

ARG PHP_EXT

RUN install-php-extensions ${PHP_EXT}

ARG UID
ARG GID

# If the group already exists, use it; otherwise, create the 'www' group
RUN if getent group ${GID}; then \
      useradd -m -u ${UID} -g ${GID} -s /bin/bash www; \
    else \
      groupadd -g ${GID} www && \
      useradd -m -u ${UID} -g www -s /bin/bash www; \
    fi && \
    usermod -aG sudo www && \
    echo 'www ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

# Switch to the non-root user to install NVM and Node.js
USER www

ARG NODE_VERSION=22.0.0
# Install NVM (Node Version Manager) as the www user
RUN export NVM_DIR="$HOME/.nvm" && \
    curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.0/install.sh | bash && \
    [ -s "$NVM_DIR/nvm.sh" ] && . "$NVM_DIR/nvm.sh" && \
    nvm install ${NODE_VERSION} && \
    nvm alias default ${NODE_VERSION} && \
    nvm use default

# Ensure NVM is available for all future shells
RUN echo 'export NVM_DIR="$HOME/.nvm"' >> /home/www/.profile && \
    echo '[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"' >> /home/www/.profile && \
    echo '[ -s "$NVM_DIR/bash_completion" ] && \. "$NVM_DIR/bash_completion"' >> /home/www/.profile

# Set the working directory
WORKDIR /var/www

# Override the entrypoint to avoid the default php entrypoint
ENTRYPOINT []

# Default command to keep the container running
CMD ["bash"]
