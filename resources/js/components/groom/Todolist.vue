<template>
    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="to-do-head">
                    <div>To Do</div>
                    <div>
                        <button class="to-do-button">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="to-do-button">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>
                <div class="to-do-content">
                    <div
                        v-for="(item, index) in toDo"
                        :key="index"
                        class="to-do-single"
                    >
                        <button class="to-do-button">
                            <i class="far fa-check-circle"></i>
                        </button>
                        <div class="to-do-single-info">
                            <div>{{ item.info }}</div>
                            <div>{{ item.time }}</div>
                        </div>
                        <button class="to-do-button">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="to-do-head">
                    <div>Doing</div>
                    <div>
                        <button class="to-do-button">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="to-do-button">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>
                <div class="to-do-content">
                    <div
                        v-for="(item, index) in doing"
                        :key="index"
                        class="to-do-single"
                    >
                        <button class="to-do-button">
                            <i class="far fa-check-circle"></i>
                        </button>
                        <div class="to-do-single-info">
                            <div>{{ item.info }}</div>
                            <div>{{ item.time }}</div>
                        </div>
                        <button class="to-do-button">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="to-do-head">
                    <div>Done</div>
                    <div>
                        <button class="to-do-button">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="to-do-button">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>
                <div class="to-do-content">
                    <div
                        v-for="(item, index) in done"
                        :key="index"
                        class="to-do-single"
                    >
                        <button class="to-do-button">
                            <i
                                class="fas fa-check-circle"
                                style="color: #2fa706"
                            ></i>
                        </button>
                        <div class="to-do-single-info">
                            <div>{{ item.info }}</div>
                            <div v-if="item.time">{{ item.time }}</div>
                            <div v-else style="padding-top: 17px"></div>
                        </div>
                        <button class="to-do-button">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            toDo: [
                {
                    id: 1,
                    info: "Book appointment with make up artist",
                    time: "Today - april 2"
                },
                { id: 2, info: "Book band baja", time: "Today - april 2" },
                {
                    id: 3,
                    info: "Book appointment with wedding planner",
                    time: "Today - april 2"
                }
            ],
            doing: [
                {
                    id: 1,
                    info: "Book appointment with make up artist",
                    time: "Today - april 2"
                },
                { id: 2, info: "Book band baja", time: "Today - april 2" }
            ],
            done: [{ id: 1, info: "Book appointment with Heena artist" }]
        };
    }
};
</script>

<style>
.to-do-head {
    display: flex;
    justify-content: space-between;
    padding: 7px;
    margin-bottom: 1em;
}
.to-do-head > div:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 23.105px;
    line-height: 31px;
    color: #461952;
}
.to-do-head button {
    color: #461952;
}
.to-do-button {
    border: none;
    outline: 0;
    background-color: inherit;
    width: 25px;
    height: 25px;
}
.to-do-single {
    border: 0.5px solid #8d8686;
    background-color: #ffffff;
    margin: 7px 0;
    display: flex;
    border-radius: 11px;
    padding: 10px;
}
.to-do-single button {
    color: #8d8686;
    outline: #8d8686;
}
.to-do-single-info {
    width: 80%;
    padding: 0 5px;
}
.to-do-single-info > div:nth-child(1) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: 600;
    font-size: 15px;
    line-height: 20px;
    color: #8d8686;
    margin-bottom: 5px;
}
.to-do-single-info > div:nth-child(2) {
    font-family: Segoe UI;
    font-style: normal;
    font-weight: normal;
    font-size: 13.0769px;
    line-height: 17px;
    color: #ca7218;
}
</style>
