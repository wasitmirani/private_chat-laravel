<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <ul>
                            <li v-for="user in users" :key="user.id">
                                {{ user.name }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                users:null,
                messages:null,
            };
        },
        mounted() {
    //         Echo.private('testchannel')
    // .listen('GetMessages', (e) => {
    //     console.log(e);
    // });
            Echo.join('users')
            .here((users)=>{
                this.users=users;
            })
            .joining((user)=>{
                this.users.push(user);
            })
            .leaving((user)=>{
                this.users.splice(this.users.indexOf(user),1);
            });


        }
    }
</script>
