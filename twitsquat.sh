#!/bin/bash

if [ "$#" -le "1" ]; then
    echo "Usage: bash twitsquat.sh [username1 username2 username3 ...] [email address]"
    echo "eg. bash twitsquat.sh username1 username2 me@example.com"
    exit 1
fi

available=( )

while [ $# -ne 1 ]; do
    echo "checking $1"
    temp=$(curl -s --head http://twitter.com/$1 | head -n 1 | grep "HTTP/1.[01] [23]..")
    if [ "$temp" == "" ]; then
        available+=("$1")
    fi
    shift
done

if [[ "${#available[@]}" != "0" ]]; then
    msg="Some twitter usernames are available! Yay!\n\n"
    for i in "${available[@]}"
    do
        msg="$msg http://twitter.com/$i \n"
    done

    echo -e $msg
    echo -e $msg | mail -s "Twitter usernames available" "${@: -1}"
fi