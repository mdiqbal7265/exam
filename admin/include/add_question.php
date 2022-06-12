<div class="modal fade" id="add-question-modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Question</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="add-question-form" method="POST">
                <input type="hidden" name="exam_id" id="exam_id">
                <div class="modal-body">
                    <!-- Question -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Question</label>
                                <textarea name="question" id="question" rows="10" cols="80">

                                </textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Option -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Option1</label>
                                <textarea name="option1" id="option1" rows="10" cols="80">

                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Option2</label>
                                <textarea name="option2" id="option2" rows="10" cols="80">

                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Option3</label>
                                <textarea name="option3" id="option3" rows="10" cols="80">

                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Option4</label>
                                <textarea name="option4" id="option4" rows="10" cols="80">

                                </textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Correct Option -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Correct Option</label>
                                <select class="form-control" id="correct_option" name="correct_option">
                                    <option>Select Correct Option</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                    <option value="4">Option 4</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Answer and Hints -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Hints</label>
                                <textarea name="hints" id="hints" rows="10" cols="80">

                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Answer</label>
                                <textarea name="answer" id="answer" rows="10" cols="80">

                                </textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Add Question" class="btn btn-info" id="add-question-btn">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>