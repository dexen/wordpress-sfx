#!/usr/bin/env rc

tarball=wordpress-5.6.3.tar.gz

mkdir -p build
mkdir -p tmp
mv tmp JUNK
mv build JUNK
rm -rf JUNK &

mkdir tmp
mkdir build
@ { cd tmp; tar xf ../tarball/$tarball }

find tmp/wordpress -type f \
	| php make-sfx.php 2 \
	> build/wordpress-sfx.php
