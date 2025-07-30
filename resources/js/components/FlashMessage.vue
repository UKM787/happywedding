<template>
    <Transition>
        <div
            v-if="alert && show"
            style="
                background-color: #d7f3e3;
                border: 1px solid #c3ecd5;
                border-radius: 0.25rem;
                padding: 10px;
                padding-right: 2em;
                color: #227444;
                min-width: 150px;
                width: max-content;
                position: fixed;
                bottom: 70px;
                right: 30px;
                padding: 1em;
                z-index: 999999999999999999999;
            "
        >
            {{ alert }}
            <span
                @click="show = false"
                style="
                    color: black;
                    margin-right: -10px;
                    padding: 10px;
                    font-size: 20px;
                    cursor: pointer;
                "
                >×</span
            >
        </div>
    </Transition>
</template>

<script>
export default {
    name: "flashMessage",
    props: ["message"],
    data() {
        return {
            show: false,
        };
    },
    methods: {},
    mounted() {
        let _this = this;
        setTimeout(function () {
            _this.show = false;
        }, 3000);
    },
    // created: function () {
    //     let _this = this;
    //     setTimeout(function () {
    //         _this.show = false;
    //         console.log(_this.show, "created");
    //     }, 3000);
    // },
    computed: {
        alert: function () {
            this.show = true;
            return this.message;
        },
    },
    // watch: {
    //     message(newValue) {
    //         setTimeout(function () {
    //             this.show = false;
    //         }, 3000);
    //     },
    // },
};
</script>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.15s linear;
}
.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
