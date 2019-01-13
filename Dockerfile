FROM mattrayner/lamp:latest-1604

WORKDIR /app

COPY . /app

EXPOSE 80

ENV NAME Astroclub
