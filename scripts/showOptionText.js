
    function showSelectedOptionText(dropdown, assessmentItemId) {
        // Get the span that corresponds to the AssessmentItemID
        var span = document.getElementById("selectedOption_" + assessmentItemId);
        
        // Update its text with the selected OptionText
        span.innerText = dropdown.value;
    }
