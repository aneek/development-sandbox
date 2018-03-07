FROM node:latest

# Install PM2
RUN npm install -g pm2

RUN npm install gulp-cli -g

RUN npm install -g generator-fountain-webapp

RUN mkdir -p /var/www/node-apps
# Define working directory
WORKDIR /var/www/node-apps

CMD pm2 start --no-daemon  processes.json