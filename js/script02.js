    //  ============= task JOB POPUP FUNCTION =========

    $(".task-jb").on("click", function(){
        $(".task-popup.task_post").addClass("active");
        $(".wrapper").addClass("overlay");
        return false;
    });
    $(".task-project > a").on("click", function(){
        $(".task-popup.task_post").removeClass("active");
        $(".wrapper").removeClass("overlay");
        return false;
    });

    //  ============= taskWrote JOB POPUP FUNCTION =========

    $(".taskWrote-jb").on("click", function(){
        $(".taskWrote-popup.taskWrote_post").addClass("active");
        $(".wrapper").addClass("overlay");
        return false;
    });
    $(".taskWrote-project > a").on("click", function(){
        $(".taskWrote-popup.taskWrote_post").removeClass("active");
        $(".wrapper").removeClass("overlay");
        return false;
    });