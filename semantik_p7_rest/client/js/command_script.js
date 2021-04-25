function updateArtists(id){
    window.location = "?navito=artistsu&aid=" + id;
}

function deleteArtists(id){
    let confirmation = window.confirm("Are you sure want to delete?");
    if (confirmation) {
        window.location = '?navito=artists&cmd=del&aid=' + id;
    }
}

function updateAlbums(id){
    window.location = "?navito=albumsu&aid=" + id;
}

function deleteAlbums(id){
    let confirmation = window.confirm("Are you sure want to delete?");
    if (confirmation) {
        window.location = '?navito=albums&cmd=del&aid=' + id;
    }
}
