// Gestionnaire d'événements pour la case à cocher "Terminer en cours"
$(document).ready(function() {
    
    $('input[type="checkbox"]').on('change', function() {
        var taskId = $(this).data('task-id');
        var taskStatus = $(this).is(':checked') ? 'complété' : 'en cours';

        $.ajax({
            url: 'update_task_status.php', 
            method: 'POST',
            data: {
                task_id: taskId,
                task_status: taskStatus
            },
            success: function(response) {
         
                console.log('État de la tâche mis à jour avec succès');
                $('#etat-' + taskId).text(taskStatus);
            },
            error: function(xhr, status, error) {
                console.error('Erreur lors de la mise à jour de l\'état de la tâche:', error);
            }
        });
    });
});

function toggleNewCategoryField() {
    var categorySelect = document.getElementById('task_category');
    var newCategoryField = document.getElementById('new_category_field');
    if (categorySelect.value === 'new_category') {
        newCategoryField.style.display = 'block';
    } else {
        newCategoryField.style.display = 'none';
    }
}
// Basculer la visibilité des options d'exportation
$(document).ready(function(){
    $("#exporter-link").click(function(e){
        e.preventDefault(); 
        $("#export-options").toggleClass("hidden"); 
    });
});

function toggleNewCategoryField() {
    var categorySelect = document.getElementById('task_category');
    var newCategoryField = document.getElementById('new_category_field');
    if (categorySelect.value === 'new_category') {
        newCategoryField.style.display = 'block';
    } else {
        newCategoryField.style.display = 'none';
    }
}
    
$(document).ready(function() {
    $(".delete-task-button").click(function() {
            var form = $(this).closest('.delete-task-form');
            var taskId = form.find('input[name="delete_task"]').val();
                
            $.ajax({
                type: "POST",
                    url: "accueil.php",
                    data: form.serialize(), 
                    success: function(response) {
                        
                        console.log(response);
                       
                        form.closest('.bg-white').remove();
                    },
                    error: function(xhr, status, error) {
                              console.error(error);
                    }
                });
        });
});

function getCookie(name) {
    let cookieArr = document.cookie.split(";");
    for (let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");
        if (name == cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}

document.addEventListener("DOMContentLoaded", function() {
    let tachesJson = getCookie("taches");
    if (tachesJson) {
        let taches = JSON.parse(tachesJson);
        console.log(taches); 
    }
});
