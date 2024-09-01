import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// در اینجا پیکربندی Pusher
window.Pusher = Pusher;

// پیکربندی Laravel Echo
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'b903aeb6cd187fecac9b',
    cluster:'sa1',
    forceTLS: true
});


window.Echo.channel('post')
    .listen('.PostLiked', (event) => {
        // بررسی وجود خاصیت `post` و `title`
        if (event.post && event.post.title) {
            alert('Post liked: ' + event.post.title);
        } else {
            console.error('Post title is not available in the event data.');
        }
    });
