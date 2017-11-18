FROM openresty/openresty:xenial

RUN apt-get update && apt-get install make gcc musl-dev luarocks libpcre3-dev curl perl git python -y

RUN git clone --recursive --branch v0.11.1 --depth 1 https://github.com/p0pr0ck5/lua-resty-waf.git /tmp/lua-resty-waf && \
    cd /tmp/lua-* && \
    make lua-aho-corasick lua-resty-htmlentities libinjection decode && make install && \
    sed -i 's/mime.types/\/usr\/local\/openresty\/nginx\/conf\/mime.types/g' /usr/local/openresty/nginx/conf/nginx.conf && \
    sed -i 's/#access_log/access_log \/dev\/stdout;#/g' /usr/local/openresty/nginx/conf/nginx.conf && \
    cp -pR '/usr/local/openresty/nginx/conf/.' '/etc/nginx/' && \
    echo "daemon off;error_log /dev/stdout;" >> "/etc/nginx/nginx.conf" && \
    ln -s /usr/local/openresty/bin/openresty /usr/local/bin/nginx && \
    cd / && rm -rf /tmp/lua-* && rm -rf /var/cache/apk/*
    
ARG RESTY_JWT_VERSION="0.1.9"

RUN cd /tmp \
    && curl -fSL https://github.com/SkyLothar/lua-resty-jwt/releases/download/v${RESTY_JWT_VERSION}/lua-resty-jwt-${RESTY_JWT_VERSION}.tar.gz -o lua-resty-jwt-${RESTY_JWT_VERSION}.tar.gz \
    && tar xzf lua-resty-jwt-${RESTY_JWT_VERSION}.tar.gz \
    && cd lua-resty-jwt-${RESTY_JWT_VERSION} \
    && cp -rf lib/* /usr/local/openresty/lualib \
    && rm -rf ../lua-resty-jwt-${RESTY_JWT_VERSION}.tar.gz \
    && rm -rf ../lua-resty-jwt-${RESTY_JWT_VERSION}
    
RUN apt-get install libssl-dev -y

RUN luarocks install luasocket \
    && luarocks install luacrypto
    
RUN cd /tmp \
    && git clone https://github.com/openresty/lua-resty-redis.git \
    && cp -rf lua-resty-redis/lib/resty/* /usr/local/openresty/lualib
    
COPY /  /usr/local/openresty/nginx/

        