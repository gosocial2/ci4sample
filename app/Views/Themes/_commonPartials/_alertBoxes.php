<?php

/* 
 * The MIT License
 *
 * Copyright 2020 Ozar <gosocial2@ozar.net>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

?>
        <?php if (isset($successMessage) && $successMessage): ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        <?= $successMessage; ?>
                    </div><!--//.alert-->
                </div><!--//.col-->
            </div><!--//.row -->
            <?php endif; ?>

            <?php if (isset($errorMessage) && $errorMessage): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fas fa-exclamation-triangle"></i> Error!</h4>
                        <?= $errorMessage; ?>
                    </div><!--//.alert-->
                 </div><!--//.col-->
            </div><!--//.row -->
            
        <?php endif; ?>