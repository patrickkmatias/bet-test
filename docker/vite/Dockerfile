FROM debian

RUN apt update && apt upgrade && apt install -y bash curl apt-utils nano

# Install NodeJS with NPM
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && apt install -y nodejs

WORKDIR /app