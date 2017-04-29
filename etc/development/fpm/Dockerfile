FROM letsbonus/php-dev:7.0

# Config
COPY conf/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN echo "alias dev='php7.0 bin/console --env=dev'" >> ~/.bashrc \
 && echo "alias test='php7.0 bin/console --env=test'" >> ~/.bashrc \
 && echo "alias prod='php7.0  bin/console --env=prod'" >> ~/.bashrc \
 && echo "alias nuke='dev d:d:d --force; dev d:d:c; dev d:s:c'" >> ~/.bashrc

# Launcher
COPY start.sh /start.sh

CMD ["/start.sh"]
