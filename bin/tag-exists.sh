#!/usr/bin/env bash
tag=$1
echo $tag;
if git rev-parse -q --verify "refs/tags/$tag" >/dev/null; then
    echo 1;
else
    echo 0;
fi