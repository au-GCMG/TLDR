document.addEventListener('DOMContentLoaded', function() {
    // 获取所有带有 "modify-button" 类的按钮
    var buttons = document.querySelectorAll('.modify-button');

    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            // 获取按钮的 action（increase 或 decrease）
            var action = this.getAttribute('data-action');
            
            // 根据按钮的 data-itemid 和 data-assessmentid 构造 span 的 ID
            var spanId = "count_" + this.getAttribute('data-itemid') + "_" + this.getAttribute('data-assessmentid');
            var span = document.getElementById(spanId);

            // 获取当前的 SignCount 值
            var currentValue = parseInt(span.textContent, 10) || 0;

            // 根据按钮的 action 更新 SignCount 的值
            if (action === "increase") {
                span.textContent = currentValue + 1;
            } else if (action === "decrease" && currentValue > 0) { // 确保 SignCount 不会变为负值
                span.textContent = currentValue - 1;
            }
        });
    });
});