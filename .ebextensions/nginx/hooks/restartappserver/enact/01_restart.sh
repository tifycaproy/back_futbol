#!/usr/bin/env bash
set -e

service php-fpm restart
service nginx restart
