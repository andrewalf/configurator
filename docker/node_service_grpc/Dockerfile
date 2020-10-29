FROM node:10.23-alpine3.9

# Install python/pip
ENV PYTHONUNBUFFERED=1
RUN apk add --update --no-cache python3 && ln -sf python3 /usr/bin/python
RUN python3 -m ensurepip
RUN pip3 install --no-cache --upgrade pip setuptools

WORKDIR /var/www/configurator

COPY package*.json ./

# rebuild npm c++ bindings for current OS
RUN npm rebuild
RUN npm install

COPY ./stub_services ./app

CMD ["node", "./app/grpc.js"]