#!/bin/bash

cd ../
sudo find ./ -type d -exec chmod 775 {} \;
sudo find ./ -type f -exec chmod 664 {} \;
sudo chmod -R 777 ./js