document.addEventListener("DOMContentLoaded", function () {
  fetchTasks();

  document
    .getElementById("add-new-task")
    .addEventListener("click", function () {
      const taskName = prompt("Enter the task name:");
      if (taskName) {
        addTask(taskName);
        fetchTasks();
      }
    });
});

function fetchTasks() {
  fetch("tasks.php")
    .then((response) => response.json())
    .then((data) => {
      const allTasksList = document.getElementById("all-tasks");
      allTasksList.innerHTML = "";
      data.forEach((task) => {
        const taskItem = document.createElement("li");
        taskItem.className = "list-group-item";
        taskItem.innerText = task.task_name;
        allTasksList.appendChild(taskItem);
      });
    });
}

function addTask(taskName) {
  fetch("add_task.php", {
    method: "POST",
    body: JSON.stringify({ taskName: taskName }),
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        console.log("Task added successfully");
      } else {
        console.log("Error adding task");
      }
    });
}
