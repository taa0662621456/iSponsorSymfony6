FROM node:18-alpine

WORKDIR /var/www/

COPY . .

RUN npm install

CMD ["npm", "run", "watch"]
