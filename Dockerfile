# 设置基础镜像
FROM spiralscout/roadrunner:2023.1.1 AS roadrunner
FROM  zhonghaibin/php8-cli-roadrunner:latest
# 定义作者
MAINTAINER zhonghaibin <756152823@qq.com>

COPY --from=roadrunner /usr/bin/rr /app/rr

# 将项目文件中的内容复制到 /app 这个目录下面
COPY . /app

#RUN php -r "file_exists('.env') || copy('.env.example', '.env');" && \
#    composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist && \
#    php artisan key:generate && \
#    chmod -R 777 storage bootstrap/cache
RUN php artisan key:generate && \
    chmod -R 777 storage bootstrap/cache
EXPOSE 8000

ENTRYPOINT  ["php", "artisan", "octane:start","--host=0.0.0.0"]

