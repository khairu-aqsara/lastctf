#!/bin/bash

filesha256() {
    sha256sum "$1" | head -c 64
}

echo "This script may break your system and please run it in snapshoted VM!"
read -r -p "Press any key to continue..." _

# destroying previous contents...
sudo umount mountpoint/
sudo losetup -d /dev/loop0
rm -f tmp/disk.img

mkdir -p tmp
mkdir -p disks
mkdir -p mountpoint

# creating new img structure
dd if=/dev/zero of=tmp/disk.img bs=1 count=0 seek=128M
/sbin/parted tmp/disk.img mklabel gpt mkpart '"My Disk"' ext4 1024KiB 100%
sudo losetup -P /dev/loop0 tmp/disk.img
sudo fdisk -l /dev/loop0
sudo mkfs.ext4 /dev/loop0p1
sudo mount /dev/loop0p1 mountpoint/

# SHALL BE MODIFIED LATER!
sudo cp flag mountpoint/
wget -nc http://picsidev.com/xx.zip -O /tmp/disk2.zip || :

# sudo mkdir mountpoint/files/
sudo 7z x /tmp/disk2.zip '-pGBNgJH-65Eg28lbIVuR8NoXB_kAKGPsW3HuO-wUi0Dw' -o/tmp/files/
sudo mv /tmp/files/ ./mountpoint/files/
sudo chmod -R ugo+r ./mountpoint/files/

# umount and split
sudo umount mountpoint/
sudo losetup -d /dev/loop0
/usr/bin/env python3 split.py
touch -t 202110070000.00 disks/*