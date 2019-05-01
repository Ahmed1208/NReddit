<template>

    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false" >
            <i class="fa fa-globe"></i>Notification <span class="badge badge-danger" id="count-notification">
                    {{ notifications.length }}
        </span>
            <span class="caret"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

            <a v-for="notification in notifications" class="dropdown-item" :href="'/comment/Read/' + notification.id + '/' + notification.data.group">
                {{notification.data.name}}<span> commented on your post</span>

            </a>

            <a v-if="notifications.length == 0" class="dropdown-item" href="#">No Notification</a>
        </div>
    </li>

</template>

<script>
    export default {

        props: ['notifications'],

    }
</script>
