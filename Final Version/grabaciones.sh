#!/bin/bash

source_dir="/usr/share/nginx/html/img/"
DB_USER="daniel"
DB_PASS="madkam"
DB_NAME="madkam"
ruta="img"

ls "$source_dir" | while read -r image; do
    if [ -f "$source_dir/$image" ]; then

        filename=$(basename "$image")

        if [[ "$filename" == grabacion1* ]]; then
            usuario_id=3
        elif [[ "$filename" == grabacion2* ]]; then
            usuario_id=2
	else
	    echo "El archivo $filename no corresponde a ninguna camara conocida."
	    continue
        fi

        day=$(echo "$filename" | cut -d'_' -f2 | cut -d'-' -f3)
        month=$(echo "$filename" | cut -d'_' -f2 | cut -d'-' -f2)
        year=$(echo "$filename" | cut -d'_' -f2 | cut -d'-' -f1)
        hour=$(echo "$filename" | cut -d'_' -f3 | cut -d':' -f1)
        minute=$(echo "$filename" | cut -d'_' -f3 | cut -d':' -f2)
        second=$(echo "$filename" | cut -d'_' -f3 | cut -d':' -f3 | cut -d'.' -f1)

        datetime="$year-$month-$day $hour:$minute:$second"

        image_path="$ruta/$image"

        exists=$(mariadb -u "$DB_USER" --password="$DB_PASS" -D "$DB_NAME" -se "SELECT COUNT(*) FROM grabaciones WHERE nombre='$filename'")

        if [ "$exists" -eq 0 ]; then
            mariadb -u "$DB_USER" --password="$DB_PASS" -D "$DB_NAME" -e "INSERT INTO grabaciones (nombre, grabaciones, fecha, usuario_id) VALUES ('$filename', '$image_path', '$datetime', '$usuario_id')"
            echo "Informacion de la imagen $filename insertada en la base de datos"
        else
            echo "La imagen $filename ya existe en la base de datos. No se insertara nuevamente."
        fi
    fi
done
