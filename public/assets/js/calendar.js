document.addEventListener("DOMContentLoaded", function () {
  let calendarEl = document.getElementById("calendar");
  let calendar = new FullCalendar.Calendar(calendarEl, {
    initialDate: "2024-06-17",
    initialView: "timeGridWeek",
    nowIndicator: true,
    headerToolbar: {
      left: "prev, next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
    },
    navLinks: true, // can click day/week names to navigate views
    editable: true,
    selectable: true,
    selectMirror: true,
    dayMaxEvents: true,
    events: [
      {
        title: "Evento de todo el día",
        start: "2023-01-01",
      },
      {
        title: "Evento largo",
        start: "2023-01-07",
        end: "2023-01-10",
      },
      {
        groupId: 999,
        title: "Evento repetido",
        start: "2023-01-09T16:00:00",
      },
      {
        groupId: 999,
        title: "Evento repetido",
        start: "2023-01-16T16:00:00",
      },
      {
        title: "Conferencia",
        start: "2023-01-11",
        end: "2023-01-13",
      },
      {
        title: "Reunión",
        start: "2023-01-12T10:30:00",
        end: "2023-01-12T12:30:00",
      },
      {
        title: "Almuerzo",
        start: "2023-01-12T12:00:00",
      },
      {
        title: "Reunión",
        start: "2023-01-12T14:30:00",
      },
      {
        title: "Happy Hour",
        start: "2023-01-12T17:30:00",
      },
      {
        title: "Cena",
        start: "2023-01-12T20:00:00",
      },
      {
        title: "Fiesta de cumpleaños",
        start: "2023-01-13T07:00:00",
      },
      {
        title: "Clic para Google",
        url: "http://google.com/",
        start: "2023-01-28",
      },
    ],
  });
  calendar.render();
});
