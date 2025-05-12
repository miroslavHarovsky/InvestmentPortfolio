FROM postgres:17.5-alpine

# Installing Vim
RUN apk update && apk add vim
