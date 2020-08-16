FROM nginx:1.15
RUN apt-get update && apt-get install -y openssl

COPY openssl.cnf /

RUN mkdir /etc/nginx/ssl && cd /etc/nginx/ssl && \
    openssl genpkey -algorithm RSA -out ca.key && \
    openssl req -x509 -key ca.key -out ca.crt \
        -subj "/CN=localhost-ca/O=localhost-ca" && \
    openssl genpkey -algorithm RSA -out "libria.dev".key && \
    openssl req -new -key "libria.dev".key -out "libria.dev".csr \
        -subj "/CN=libria.dev/O=localhost-ca" && \
    openssl x509 -req -in "libria.dev".csr -days 365 -out "libria.dev".crt \
        -CA ca.crt -CAkey ca.key -CAcreateserial \
        -extfile /openssl.cnf