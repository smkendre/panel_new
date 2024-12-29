// const { model } = require("mongoose");

$(function () {
  const chatForm = document.getElementById("chat-form");
  const chatMessages = document.querySelector(".chat-messages");
  const imgUser = document.getElementById("img-user");
  const userList = document.getElementById("users");
  const usersList = document.getElementById("user-list");
  const usersListSidebar = document.getElementById("user-list-sidebar");
  const usersListTotal = document.getElementById("total-user-list");
  const pageUsers = document.getElementById("users-page");
  // const totalUsers = document.getElementById('total-users');
  const page = document.getElementById("page").value;
  const qnalist = document.getElementById("qna-list");
  const pollQuestion = document.getElementById("poll-question");

  var user_cookie;
  var email = $("#email").val();

  if (email) {
    setCookie(
      "userCookie",
      [
        $("#name").val(),
        $("#email").val(),
        $("#job_title").val(),
        $("#company").val(),
        $("#user_id").val(),
      ],
      1
    );
    user_cookie = getCookie("userCookie");
  } else {
    user_cookie = getCookie("userCookie");
  }

  var user_cookie = user_cookie.split(",");
  // console.log(user_cookie);

  const socket = io("https://dev.expressbpd.in");
  // var socket = io('http://localhost:3000/main');
  // console.log(username, room);

  //Live Attendees Count
  socket.emit("attendeesCount", {
    name: user_cookie[0],
    email: user_cookie[1],
    jobtitle: user_cookie[2],
    company: user_cookie[3],
    page: page,
    events: 16,
    userId: user_cookie[4],
  });

  socket.on("refresh_agenda", function (data) {
    console.log("Refresh agenda");
    ajax_agenda_load();
  });
  // socket.on("announcement", function (data) {
  //   // const alertMsg =
  //   //   "Announcement Received \n Title: - " +
  //   //   data.title +
  //   //   " \n Message: - " +
  //   //   data.message +
  //   //   " \n URL: - " +
  //   //   data.url;
  //       $("#announsmessage .tac label").html(data.title);
  //      $("#announsmessage .desc").html(data.message);

  //     if(data.url){
  //       $("#announsmessage .actionBtn a").attr('href', data.url);
  //     }else{
  //       $("#announsmessage .actionBtn ").hide();
  //     }

  //   // imgUser.src = data.url;

  //   // const alertMsg = ' <div id="announsmes" class="popmain3"><div class="popmainheading">Announcement Message</div><div class="popmain1con1"> <div class="popupformmain1"> <p class="tac">'+data.title+'</p><p class="desc">'+data.message+'</p>  <br><div class="btn2 actionBtn "><a href="'+data.url+'">Join Now</a></div> </div></div> <button type="button" data-fancybox-close="" class="fancybox-button fancybox-close-small" title="Close"></button></div>';

  //   $.fancybox.open($("#announsmessage"));
  // });

  socket.on("chatInvitation", (data) => {
    // console.log(data);
    $.fancybox.close();
    const Hirenvideomsg = document.getElementById("Hirenvideomsg");

    Hirenvideomsg.innerHTML = `
    <div class="popmainheading">Chat Invitation</div>
      <div class="popmain1con1">
          <div class="popupformmain1">
              <p class="tac"><label><span>${data}</span><br>Is inviting you to have a private chat </label></p>
              <br>
              <div class="btn2 tac"><a data-fancybox data-src="#chatpop" data-options='{"touch": false}' href="javascript:" id="chatAccept" onclick="${data}">Accept</a> <a href="javascript:" id="chatDecline">Decline</a></div>
          </div>
      </div>`;

    $.fancybox.open(Hirenvideomsg);
  });

  socket.on("liveattendees", (data) => {
    console.log("Now attending users: ");
    console.log(data);
    if (data) {
      document.getElementById("livecount").innerHTML = data.length;

      var html = `
    
          ${data
            .map(
              (user) => `
          <div class="popupattenchat">
          <h6><span>${user.name}</span> ${user.jobtitle}, ${user.company}</h6>
          
  
          <a data-fancybox data-src="#HirenMistry" data-options='{"touch": false}' href="javascript:;"><i
                  class="fa fa-envelope"  onclick="sendmessage('${user.userId}', '${user.name}', '${user.email}');"></i></a>
  
        </div>
            `
            )
            .join("")}
      `;
      // usersList.innerHTML = html;
      usersList.innerHTML = usersListSidebar.innerHTML = html;
    }
  });

  socket.on("qnaAnnouncement", (data) => {
    console.log("Qnas: ");
    console.log(data);
    if (data) {
      var html = `
    
          ${data
            .map(
              (qna) => `
          <div class="popupattenchat">
          <h6><span>${qna.question}</span> ${qna.attendeeName}</h6>
          
        </div>
            `
            )
            .join("")}
      `;
      qnalist.innerHTML = html;
    }
  });

  // $(document).on("click", ".onechat",function(){
  //   var socketChatId = $(this).attr("onclick");
  //   var name = $('#name').val();

  //   socket.emit("chatInvitation", {
  //     socketid: socketChatId,
  //     username: name
  //   });

  //   alert('Chat Invitation Sent');
  //   // $.fancybox.open('#chatpop');
  //   // $.fancybox.close('.popmain1');

  //   // console.log(script);
  // });

  socket.on("startsession", (data) => {
    //console.log(data);
    $("#announsmessage .tac label").html(data.title);
    $("#announsmessage .desc").html(data.message);

    if (data.url) {
      $("#announsmessage .actionBtn a").attr(
        "href",
        JS_URL + "lobby/" + data.url
      );
    } else {
      $("#announsmessage .actionBtn ").hide();
    }

    var users = $(".active_users")
      .map(function (i, el) {
        return el.value;
      })
      .get()
      .join(",");

    //  var userstring = users.join();
    // console.log("active users");
    // console.log(users);

    // register_session_users(data.event_id, users);
    setCookie("event_id", data.event_id);
    // $("#event_id").val(event_id);
    // $("#live-"+event_id).show();
    ajax_agenda_load();
    $.fancybox.open($("#announsmessage"), {
      overlay: null,
      afterLoad: function () {
        setTimeout("$.fancybox.close();", 4000);
      },
    });
  });

  socket.on("totalattendees", (data) => {
    document.getElementById("totalcount").innerHTML = data.length;

    usersListTotal.innerHTML = `
   
    ${data
      .map(
        (user) => `
    <div class="popupattenchat">
    <h6><span>${user.name}</span> ${user.jobtitle}, ${user.company}</h6>
    
    <a data-fancybox data-src="#HirenMistry" id="user${user.userId}" data-options='{"touch": false}' href="javascript:;"><i
            class="fa fa-envelope sndMsg "  onclick="sendmessage( '${user.userId}', '${user.name}', '${user.email}');"></i></a>
  
  </div>
      `
      )
      .join("")}
  `;

    // totalUsers.innerHTML = `
    //     <tr>
    //       <th>Name</th>
    //       <th>Email</th>
    //       <th>jobtitle</th>
    //       <th>Company</th>
    //     </tr>
    //     ${data.map(user => `
    //       <tr>
    //         <td>${user.name}</td>
    //         <td>${user.email}</td>
    //         <td>${user.jobtitle}</td>
    //         <td>${user.company}</td>
    //       </tr>
    //       `).join('')}
    // `;
  });

  //Join Chat Room
  // socket.emit("joinRoom", { username, room });

  //Get Rooms & Users
  socket.on("roomUsers", ({ room, users }) => {
    //console.log("roomUsers");
    //console.log(users);
    //   document.getElementById("pagecount").innerHTML = users.length;
    //   pageUsers.innerHTML = `
    //   ${users
    //     .map(
    //       (user) => `
    //   <div class="popupattenchat">
    //   <h6><span>${user.name}</span> ${user.jobtitle}, ${user.company}</h6>
    //   <a href="javascript:;" class="onechat" onclick="${user.socketId}"><i class="fa fa-comments"></i></a>
    //   <a data-fancybox data-src="#HirenMistry" data-options='{"touch": false}' href="javascript:;"><i
    //           class="fa fa-envelope"  onclick="sendmessage( '${user.userId}', '${user.name}', '${user.email}');"></i></a>
    //           <input type="hidden" name="user[]" class="active_users" value="${user.userId}" />
    // </div>
    //     `
    //     )
    //     .join("")}
    // `;
    // outputRoomName(room);
    // outputUsers(users);
  });

  // Get room and users
  socket.on("message", (message) => {
    // console.log(message);
    outputMessage(message);

    //Scroll down to new Message
    chatMessages.scrollTop = chatMessages.scrollHeight;
  });

  //Message Submit
  // chatForm.addEventListener('submit', e => {
  //     e.preventDefault();
  //     //Get Message Text
  //     const msg = e.target.elements.msg.value;

  //     //Emit Message to Server
  //     socket.emit('chatMessage', msg);

  //     //Clear Input Message
  //     e.target.elements.msg.value = '';
  //     e.target.elements.msg.focus();
  // });

  //Output Message to DOM
  function outputMessage(message) {
    const div = document.createElement("div");
    div.classList.add("message");
    div.innerHTML = `<p class="meta">${message.username} <span>${message.time}</span></p>
      <p class="text">
          ${message.text}
      </p>`;

    document.querySelector(".chat-messages").appendChild(div);
  }

  //Add Room Name to DOM
  function outputRoomName(room) {
    roomName.innerHTML = room;
  }

  //Add Users to DOM
  function outputUsers(users) {
    document.getElementById("pagecount").innerHTML = users.length;
    //  console.log("Connetion Count: - " + users.length);
    pageUsers.innerHTML = `
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Email</th>
          <th>jobtitle</th>
          <th>Company</th>
          <th>Page</th>
        </tr>
        ${users
          .map(
            (user) => `
          <tr>
            <td>${user.id}</td>
            <td>${user.name}</td>
            <td>${user.email}</td>
            <td>${user.jobtitle}</td>
            <td>${user.company}</td>
            <td>${user.page}</td>
          </tr>
          `
          )
          .join("")}
    `;
    // userList.innerHTML = `
    //     ${users.map(user => `<li>${user.username}</li>`).join('')}
    // `;
  }

  // poll question
  socket.on("pollAnnouncement", function (data) {
    console.log("Poll Questions: " + data);

    pollQuestion.innerHTML = `
  ${data
    .map(
      (user) => `
  <input type="hidden" name="pollid" id="pollid" value="${user._id}">

  <h6>${user.question}</h6>
  <label class="radiobtn1">
      <input type="radio" name="poll_experience" value="${user.opt1}">
      <span class="radiocheckmark1"></span>
      ${user.opt1}
  </label>
  <label class="radiobtn1">
      <input type="radio" name="poll_experience" value="${user.opt2}">
      <span class="radiocheckmark1"></span>
      ${user.opt2}
  </label>
  <label class="radiobtn1">
      <input type="radio" name="poll_experience" value="${user.opt3}">
      <span class="radiocheckmark1"></span>
      ${user.opt3}
  </label>
  <label class="radiobtn1">
      <input type="radio" name="poll_experience" value="${user.opt4}">
      <span class="radiocheckmark1"></span>
      ${user.opt4}
  </label>
        `
    )
    .join("")}
  `;

    $.fancybox.open($("#poll"));
  });

  socket.on("pollResult", function (data, question) {
    console.log(data);

    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      theme: "light2", // "light1", "light2", "dark1", "dark2"
      title: {
        text: "Poll Result",
      },
      axisY: {
        title: "Percentage (%)",
      },
      data: [
        {
          type: "column",
          showInLegend: true,
          legendMarkerColor: "",
          legendText: question,
          dataPoints: data,
        },
      ],
    });
    chart.render();

    $.fancybox.open($("#pollresult"));
  });

  socket.on("disconnect", (reason) => {
    console.log(`Disconnected: ${reason}`);
  });

  socket.on("reconnect", (reason) => {
    console.log(`reconnect: ${reason}`);

    socket.emit("attendeesCount", {
      name: user_cookie[0],
      email: user_cookie[1],
      jobtitle: user_cookie[2],
      company: user_cookie[3],
      page: page,
      userId: user_cookie[4],
    });
  });

  function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(";");
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == " ") {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
});
