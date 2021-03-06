<!-- View Student Modal-->
<div class="modal fade" id="chartTypeModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Show Data of: </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./includes/chartDataType.php?<?php echo $_GET['id']; ?>" method="POST">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="chartDataType">Data of:</label>
                                <select id="" class="form-control" name="chartDataType">
                                    <option value=""></option>
                                    <option value="municipality">Municipality</option>
                                    <option value="school">School</option>
                                    <option value="course">Course</option>
                                    <option value="status">Status</option>
                                    <option value="student">Student</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="year">Year</label>
                                <input class="form-control" type="text" name="year" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="btnChartType" class="btn btn-info">Select</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
