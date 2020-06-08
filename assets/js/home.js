$(function () {
  $.get(
    './assets/hndlr/Homepage.php',
    {
      images: 'images',
    },
    function (data) {
      const arrayData = JSON.parse(data);
      let currentDate = new Date(),
        formatCRDate =
          (currentDate.getMonth() + 1).toString().padStart(2, '0') +
          currentDate.getDate() +
          currentDate.getFullYear(),
        dateArray = [];

      arrayData.forEach((el) => {
        let date = el.end_date.split(' ')[0].split('/'),
          dateM = date[0],
          dateD = date[1],
          dateY = date[2];
        dateFormat = dateM + dateD + dateY;
        dateFormat <= formatCRDate && dateArray.push(el);
      });
      //EVENTS
      dateArray
        .slice(0, 3)
        .sort((a, b) => {
          b.end_date - a.end_date;
        })
        .forEach((el) => {
          let cipherData = cipher(el.evnt_id.toString());
          let link = `./article.php?event=${cipherData}`;
          $('div[id*=events]').prepend(
            `<div class="col-12 col-md-6 col-lg-4">
                <div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="300ms">
                    <a href="${link}" class="post-thumbnail"><img src="./files/events/${
              el.image
            }" alt="" style="height: 200px;"></a>
                    <!-- Post Meta -->
                    <div class="post-meta">
                         <a href="${link}" class="post-date">${jQuery.timeago(
              el.created_at
            )}</time></a>
                    </div>
                    <!-- Post Title -->
                    <a href="${link}" class="post-title">${el.title}</a>
                    <div class="overlap-text"  style="overflow-wrap: break-word;">
                       ${el.description}
                    </div>
                    <a href="${link}" class="btn continue-btn"><i class="fa fa-long-arrow-right"
                            aria-hidden="true"></i></a>
                </div>
            </div>`
          );
        });

      dateArray.length == 0 &&
        $('div[id*=events]').prepend(`
              <div style="width: 100%;text-align: center;padding: 5%;font-size: 130%;margin-bottom: 60px;border: 2px solid rgba(42, 48, 59, 0.22);border-radius: 40px 40px 40px 40px;color: #1cb6a8;">
                There are no upcoming events at this time...
              </div>
          `);

      //SINGLE EVENT(UPPER HEADER)
      arrayData
        .slice(0, 1)
        .sort((a, b) => {
          b.end_date - a.end_date;
        })
        .forEach((el) => {
          let cipherData = cipher(el.evnt_id.toString()),
            link = `./article.php?event=${cipherData}`,
            user = $(`input[id*=user_rn]`).val();
          register =
            user != 0
              ? `<a href="./events.php"><button type="button" class="form-control btn roberto-btn w-100 font-weight-bold"
                            >EVENTS</button></a>`
              : `<a href="./create-profile.php"><button type="button" href="./create-profile.php" class="form-control btn roberto-btn w-100 font-weight-bold"
                            >REGISTER</button></a>`;

          $(`div[id*=SingleEvent]`)
            .append(`<div class="col-12 col-md-12 col-lg-6 mb-4">
                        <div class="single-recent-post d-flex">
                            <!-- Thumb -->
                            <div class="post-thumb">
                                <a href="${link}"><img src="./files/events/${el.image}" alt=""></a>
                            </div>
                            <div class="post-content">
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <a href="${link}" class="post-author">${el.start_date}</a>
                                    <a href="${link}" class="post-tutorial">${el.venue}</a>
                                </div>
                                <!-- Post Title -->
                                <a href="${link}" class="post-title">${el.title}</a>
                                <a href="${link}" class="btn continue-btn">Read details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">${register}</div>`);
        }) 
    }
  );

  $.get(
    './assets/hndlr/Homepage.php',
    {
      homepage: 'homepage',
    },
    function (data) {
      let res = JSON.parse(data);
      let content = $('#content'),
        title = $('#title'),
        signature = $('#signature'),
        image1 = $('#image1'),
        image2 = $('#image2'),
        image3 = $('#image3');

      [res.contents].forEach((el) => {
        el.content == ''
          ? content.html(el.alternative_content)
          : content.html(el.content);
        el.title == '' ? title.html(el.title) : title.html(el.title);
        el.signature == '' || el.signature == 'none'
          ? signature.css({
              display: 'none',
            })
          : signature.attr('src', el.meta2);
      });
      let tmp = res.images;
      //For Testing
      //tmp.splice(2,1)
      //tmp.splice(1,1)
      
      //for future use in the image divs design
      const imageArray1 = ['image-1', 'image-2'],
        imageArray2 = ['image-3'];
      let filterAr1 = tmp.filter((el) => {
          return el.image == 'image-1' || el.image == 'image-2';
        }),
        filterAr2 = tmp.filter((el) => {
          return el.image == 'image-3' || el.image == 'image-4';
        });
      const getxist = (array, option) => {
        let notExist = [];
        option == 'div1'
          ? filterAr1.length > 0
            ? array.forEach((image) => {
                filterAr1.forEach((existImage) => {
                  existImage.image !== image ? notExist.push(image) : ''; //Not exist
                });
              })
            : (notExist = [...imageArray1])
          : filterAr2.length > 0
          ? array.forEach((image) => {
              filterAr2.forEach((existImage) => {
                existImage.image !== image ? notExist.push(image) : ''; //existed
              });
            })
          : (notExist = [...imageArray2]);
        return notExist;
      };

      const imageDiv1 = getxist(imageArray1, 'div1'); //Not existed for div1
      const imageDiv2 = getxist(imageArray2, 'div2'); //Not existed for div2

      if (tmp > 0) {
        //console.log(filterAr1.length)
        if (filterAr1.length > 0) {
          filterAr1.forEach((el) => {
            let imageNumber = el.image.split('-')[1];
            $(`img[id*=image${imageNumber}]`).attr('src', el.folder);
          });
        } else {
          image1.parent().parent().css({
            display: 'none',
          });
          image3.parent().parent().attr('class', 'col-10');
        }

        imageDiv1.length < 2 &&
          imageDiv1.forEach((el) => {
            let imageNumber = el.split('-')[1];
            $(`img[id*=image${imageNumber}]`).parent().css({
              display: 'none',
            });
          });

        if (filterAr2.length > 0) {
          filterAr2.forEach((el) => {
            let imageNumber = el.image.split('-')[1];
            $(`img[id*=image${imageNumber}]`).attr('src', el.folder);
          });
        } else {
          image3.parent().parent().css({
            display: 'none',
          });
          image1.parent().parent().attr('class', 'col-10');
        }
      }
    }
  );
});
