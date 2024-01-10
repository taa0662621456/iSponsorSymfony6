FROM nginx:alpine

WORKDIR /usr/share/nginx/html

COPY ./public/upload /usr/share/nginx/html

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
