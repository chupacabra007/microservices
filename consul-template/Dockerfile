FROM alterway/consul-template-nginx:0.12-dockerinside-1.11 
COPY nginx.ctmpl /etc/ctmpl/nginx.ctmpl 
WORKDIR /etc/ctmpl 
ENTRYPOINT ["/usr/bin/consul-template"]