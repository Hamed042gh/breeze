import Echo from "laravel-echo";
import Pusher from "pusher-js";
import Swal from "sweetalert2";

window.Pusher = Pusher;

window.Echo = new Echo({
    authEndpoint: "/broadcasting/auth",
    broadcaster: "pusher",
    key: "b903aeb6cd187fecac9b",
    cluster: "sa1",
    forceTLS: true,
});

document.querySelectorAll(".post-item").forEach((post) => {
    const postId = post.getAttribute("data-post-id");

    window.Echo.private("post." + postId).listen(".PostLiked", (event) => {
        Swal.fire({
            title: "Post Liked!",
            text:
                event.user.name +
                ' liked your post "' +
                ".\n" +
                event.post.title +
                '".\n',
            icon: "success",
            confirmButtonText: "OK",
        });
    });
});
