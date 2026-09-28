<div class="col-lg-12 mt-3">
    <div class="steps">
        <progress id="progress" value={{$progressBar['progress']}} max=100></progress>
        <div class="step-item">
            <button class="step-button text-center" type="button"
                onclick="window.location='/users/annexure-one/{{$progressBar["application_id"]}}'"
                aria-expanded="{{$progressBar['annexure1']}}" aria-controls="collapseOne">
                1
            </button>
            <div class="step-title">
                Annexure
            </div>
        </div>
        <div class="step-item">
            <button class="step-button text-center collapsed" type="button"
                onclick="window.location='/users/annexure-two/{{$progressBar["application_id"]}}'"
                aria-expanded="{{$progressBar['annexure2']}}" aria-controls="collapseTwo">
                2
            </button>
            <div class="step-title">
                Annexure
            </div>
        </div>
        <div class="step-item">
            <button class="step-button text-center collapsed" type="button"
                onclick="window.location='/users/annexure-three/{{$progressBar["application_id"]}}'"
                aria-expanded="{{$progressBar['annexure3']}}" aria-controls="collapseThree">
                3
            </button>
            <div class="step-title">
                Annexure
            </div>
        </div>
        <div class="step-item">
            <button class="step-button text-center collapsed" type="button"
                onclick="window.location='/users/annexure-four/{{$progressBar["application_id"]}}'"
                aria-expanded="{{$progressBar['annexure4']}}" aria-controls="collapseThree">
                4
            </button>
            <div class="step-title">
                Annexure
            </div>
        </div>
        <div class="step-item">
            <button class="step-button text-center collapsed" type="button"
                onclick="window.location='/users/annexure-five/{{$progressBar["application_id"]}}'"
                aria-expanded="{{$progressBar['annexure5']}}" aria-controls="collapseThree">
                5
            </button>
            <div class="step-title">
                Annexure
            </div>
        </div>
        <div class="step-item">
            <button class="step-button text-center collapsed" type="button"
                onclick="window.location='/users/annexure-six/{{$progressBar["application_id"]}}'"
                aria-expanded="{{$progressBar['annexure6']}}" aria-controls="collapseThree">
                6
            </button>
            <div class="step-title">
                Annexure
            </div>
        </div>
        <div class="step-item">
            <button class="step-button text-center collapsed" type="button"
                onclick="window.location='/users/annexure-seven/{{$progressBar["application_id"]}}'"
                aria-expanded="{{$progressBar['annexure7']}}" aria-controls="collapseThree">
                7
            </button>
            <div class="step-title">
                Annexure
            </div>
        </div>
        <div class="step-item">
            <button class="step-button text-center collapsed" type="button"
                onclick="window.location='/users/annexure-eight/{{$progressBar["application_id"]}}'"
                aria-expanded="{{$progressBar['annexure8']}}" aria-controls="collapseThree">
                8
            </button>
            <div class="step-title">
                Annexure
            </div>
        </div>

    </div>
</div>
<style>
:root {
    --prm-color: #0381ff;
    --prm-gray: #b1b1b1;
}

.steps {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    position: relative;
}

.step-button {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: none;
    background-color: var(--prm-gray);
    transition: .4s;
}

.step-button[aria-expanded="true"] {
    width: 30px;
    height: 30px;
    background-color: var(--prm-color);
    color: #fff;
}

.done {
    background-color: var(--prm-color);
    color: #fff;
}

.step-item {
    z-index: 10;
    text-align: center;
}

#progress {
    -webkit-appearance: none;
    position: absolute;
    width: 98%;
    z-index: 5;
    height: 10px;
    margin-left: 18px;
    margin-bottom: 18px;
}

/* to customize progress bar */
#progress::-webkit-progress-value {
    background-color: var(--prm-color);
    transition: .5s ease;
}

#progress::-webkit-progress-bar {
    background-color: var(--prm-gray);

}

</style>
