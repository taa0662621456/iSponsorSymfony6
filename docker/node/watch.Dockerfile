FROM node:18-alpine

WORKDIR /var/www/

RUN npm install

CMD ["npm", "run", "watch"]
