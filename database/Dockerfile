FROM postgres:latest

ENV POSTGRES_PASSWORD=root
ENV POSTGRES_DB=addressdb
ENV POSTGRES_USER=root

EXPOSE 5432

COPY init.sql /docker-entrypoint-initdb.d/