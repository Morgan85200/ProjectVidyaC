// import $ from 'jquery';

// $(document).ready(function() {
//     $('.favorite-button').click(function() {
//         var gameId = $(this).data('game-id');
//         var userId = $(this).data('user-id'); // Add this line to retrieve the user ID from a data attribute

//         var button = $(this);

//         $.ajax({
//             type: 'POST',
//             url: '/user/' + userId + '/toggle-favorite/' + gameId,
//             success: function(response) {
//                 if (response.isFavorited) {
//                     button.text('Remove from Favorites');
//                 } else {
//                     button.text('Add to Favorites');
//                 }
//             },
//             error: function() {
//                 alert('An error occurred while processing your request.');
//             }
//         });
//     });
// });
