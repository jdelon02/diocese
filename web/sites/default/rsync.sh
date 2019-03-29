export ENV=dev
# Usually dev, test, or live
export SITE=2aa0885c-4b94-4a7e-8dd4-d8a7423b1b83
# Site UUID from dashboard URL: https://dashboard.pantheon.io/sites/[uuid]

# To Upload/Import
rsync -rLvz --size-only --ipv4 --progress -e 'ssh -p 2222' ./files/. --temp-dir=~/tmp/ $ENV.$SITE@appserver.$ENV.$SITE.drush.in:files/

# To Download
# rsync -rvlz --copy-unsafe-links --size-only --ipv4 --progress -e 'ssh -p 2222' $ENV.$SITE@appserver.$ENV.$SITE.drush.in:files/ ~/files


# -r: Recurse into subdirectories
# -v: Verbose output
# -l: copies symlinks as symlinks
# -L: transforms symlinks into files.
# -z: Compress during transfer
# --copy-unsafe-links: transforms symlinks into files when the symlink target is outside of the tree being copied
# Other rsync flags may or may not be supported
# (-a, -p, -o, -g, -D, etc are not).
