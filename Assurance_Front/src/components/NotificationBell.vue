<template>
    <div>
        <i class="notification-icon" @click="toggleNotifications">
            <span class="notification-count">{{ notifications.length }}</span>
        </i>
        <div v-if="showNotifications" class="notification-dropdown">
            <ul>
                <li v-for="notification in notifications" :key="notification.id">
                    {{ notification.data.message }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from './axios';

export default {
    data() {
        return {
            notifications: [],
            showNotifications: false,
        };
    },
    methods: {
        toggleNotifications() {
            this.showNotifications = !this.showNotifications;
        },
        async fetchNotifications() {
            try {
                const response = await axios.get('/notifications');
                this.notifications = response.data;
            } catch (error) {
                console.error('Error fetching notifications:', error);
            }
        }
    },
    mounted() {
        this.fetchNotifications();
    }
}
</script>

<style>
.notification-icon {
    position: relative;
    cursor: pointer;
}
.notification-count {
    position: absolute;
    top: 0;
    right: 0;
    background: red;
    color: white;
    border-radius: 50%;
    padding: 2px 5px;
}
.notification-dropdown {
    position: absolute;
    background: white;
    border: 1px solid #ccc;
    width: 200px;
}
</style>
