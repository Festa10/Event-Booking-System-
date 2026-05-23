function deleteEvent(id) {

    if(confirm("Are you sure?")) {

        fetch("ajax_delete.php?id=" + id)
        .then(res => res.text())
        .then(data => {

            if(data.trim() == "success") {
                document.getElementById("row-" + id).remove();
            }

        });

    }
}