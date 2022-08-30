@extends('layoutsAgent.app')
@section('content')
<div class="content-wrapper">


    <div class="center">
  
        <div class="contacts" id="list">
            <!-- <i class="fas fa-bars fa-2x"></i> -->
        
            <!-- SCRIPT -->
        </div>

        <script>
                $(document).ready(function (){

                    $('#list').html('');

                    $.ajax({

                        url: "/agentpanel-list",
                        method:'get',
                        dataType: 'JSON',
                        success: function(response){
                            $('#list').append(
                                "<h2>Agents</h2>"
                            )
                        
                            $.each(response.lists, function(key,list){

                                if(list.id == {{session('id')}})
                                {
                                    return;
                                }
                                $('#list').append(

                                    "<div class='contact'>"+
                                        "<div class='pic rogers'></div>"+
                                        // "<div class='name'>"+
                                        "<button id="+list.id+" onclick='hello()' style='width: -webkit-fill-available;margin-right:169px;' class = 'btn loader'>"+ list.name+ "</button>"+
                                        "<div class='message'>"+
                                        list.email+
                                        "</div>"+
                                    "</div>"
                                );

                            });
                        }
                    });
                });
            </script>

           
<!-- ---------------------------------------------second division------------------------------------------------------- -->
            
        <div class="chat" id="display" style="visibility:hidden;">

            <div class="contact bar"   >
                <div class="pic stark"></div>
                <div class="row">
                    <div class="name col-lg-6">
                        <!-- SCRIPT -->
                    </div>
                    <div class="col-lg-2">
                        <form method="POST" action="create">
                            @csrf
                            <input type="hidden" id="backup" vlaue="" name="backupid">
                            <button type="submit" class="btn" id="backup">Backup Chat</button>
                        </form>
                    </div>
                    <div class="col-lg-2">
                        <form method="POST" action="deletechat">
                            @csrf
                            <input type="hidden" id="delete" value="" name="idd">
                            <button type="submit" class="btn" id="delete" onclick="return confirm('Are you sure?')">Delete Chat</button>
                        </form>
                    </div>
                    <div class="col-lg-2">
                        <form method="POST" action="restorechat">
                            @csrf
                            <input type="hidden" id="restore" value="" name="restoreid">
                            <button type="submit" class="btn" id="restore">Restore Chat</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="messages" id = "chatbox" style="overflow-x:hidden;">
            <!-- script -->
            </div>

            <div class="input" >
                @csrf
                <input type="text" id='message' name="message" onkeyup="disableButton()" value="" placeholder="Type Message ..." class="form-control">
                <input type="hidden" id='sender' name="sender" value="{{session('id')}}">
                <input type="hidden" id="rec" name="receiver" value="">

                <button type="submit" class="btn btn-primary disabled" id="sendMsg">Send</button>
                
            </div>
        </div>
                
    </div>
            
    <script>
        function hello()
        {
            var x = document.getElementById("display");
            if(x.style.visibility == "hidden")
            {
                x.style.visibility = "visible";
            }
            else
            {
                x.style.visibility = "visible";
            }               
        }
    </script>
                   

    <script>
        function disableButton()
        {
            if(document.getElementById('message').value != "")
            {
                document.getElementById('sendMsg').classList.remove("disabled");
            }
            else if(document.getElementById('message').value == "")
            {
                document.getElementById('sendMsg').classList.add("disabled");
            }
        }
    </script>     

    <script>
        $("#message").keypress(function(event) {
            if (event.keyCode === 13) {
                $("#sendMsg").click();
            }
        });
    </script>
           
    <script> 

        $(document).ready(function (){

            $(document).on('click','.loader',function(){
                let id = this.id;
                $("#rec").val(id);
                $('#delete').val(id);
                $('#backup').val(id);
                $('#restore').val(id);

                fetchChat(id);

                const refreshchat = setInterval(function(){

                    // $(document).on('click','.loader',function(){
                    //     let iid = this.id;
                    //     $("#rec").val(iid);
                        
                    //     stopLoading();
                    //     fetchChat(iid);
                    // });

                    $(document).on('click','.loader',function(){
                        
                        stopLoading();
                        // fetchChat(iid);
                    });
                
                    fetchChat(id);

                }, 7000);

                function stopLoading(){
                    clearInterval(refreshchat);
                }

            });   

            $(document).on('click','#sendMsg',function(){
            var id = $("#rec").val();
            let data = {
                'sender': $("#sender").val(),
                'receiver': $("#rec").val(),
                'message': $("#message").val()
            }
            saveChat(data);
            fetchChat(id);
            });   

            function saveChat(data){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/savechat",
                    method:'POST',
                    data: data,
                    dataType: 'JSON',
                    success: function(response){
                        console.log(response.message);
                    },
                });

                $("#message").val('');
            }


            function fetchChat(id){
                $('#chatbox').html('');
                $.ajax({

                    url: "/loadchat/"+id,
                    method:'get',
                    dataType: 'JSON',
                    success: function(response) {
                        $('.name').empty();
                        $('.name').append(response.name);

                        $.each(response.messages, function(key,chat){
                        
                            if(chat.type == 'incoming')
                            {
                                $('#chatbox').append(
                                    "<div class='time-receive'>"+
                                    chat.time+
                                    "</div>"+
                                    "<div class='message receive'>"
                                        +chat.message +
                                    "</div>"

                                );
                            }

                            else if(chat.type == 'outgoing')
                            {
                                $('#chatbox').append(
                                    "<div class='time-send'>"+
                                        chat.time+
                                    "</div>"+
                                    "<div class='message send'>"+
                                        chat.message +
                                    "</div>"
                                );
                            } 
                        });
                        var messageBody = document.querySelector('#chatbox');
                        messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                    }
                });
            }
        });
    </script> 

</div> 
@endsection