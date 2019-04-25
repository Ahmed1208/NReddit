<template>
    <li class="dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false" >
            <i class="fa fa-globe"></i>Notification <span class="badge badge-danger" id="count-notification"></span>
            <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li v-for="notification in notifications">
                <a href="#">{{JSON.parse(notification.data).post.id}}</a>

            </li>
        </ul>

    </li>
</template>

<script>
    export default {
        props:['notifications']
    }
</script>
