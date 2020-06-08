<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <div id="app">

        <input type="text" id="test-input" v-model="message">

        <p>The data is @{{ message }}.</p>

        <ul>
            <li v-for="name in names">@{{ name }}</li>
        </ul>
        <input type="text" v-model="newName"><input type="button" value="Save Name" v-on:click="addName">

        <button :title="title">Save</button>
    </div>

    <script src="{{ asset('js/vue.js') }}"></script>

    <script>

        let data = {
            message: "yes",
            newName: "",
            title: "Save Data Button Title",
            names: ["Ahmed", "Ali", "Muhammed", "Mahmoud"]
        };

        // document.querySelector("#test-input").value = data.message;
        new Vue({
            el: "#app",
            data: data,
            methods: {
                addName() {
                    this.names.push(this.newName);
                    this.newName = "";
                }
            }
        });
    </script>

</body>
</html>
