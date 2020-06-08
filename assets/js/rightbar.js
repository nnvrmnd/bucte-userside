$(function () {
  $.get('./assets/hndlr/Homepage.php', { images: 'images' }, function (data) {
    const arrayData = JSON.parse(data);
    let currentDate = new Date(),
      formatCRDate =
        (currentDate.getMonth() + 1).toString().padStart(2, '0') +
        currentDate.getDate() +
        currentDate.getFullYear(),
      dateArray = [];
    // arrayData.forEach((el) => {
    //   let date = el.end_date.split(' ')[0].split('/'),
    //     dateM = date[0],
    //     dateD = date[1],
    //     dateY = date[2];
    //   dateFormat = dateM + dateD + dateY;
    //   dateFormat < formatCRDate && dateArray.push(el);
    // });
    //EVENTS
    arrayData
      .slice(0, 4)
      .sort((a, b) => {
        b.end_date - a.end_date;
      })
      .forEach((el) => {
        const months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
        let cipherData = cipher(el.evnt_id.toString()),
              link = `./article.php?event=${cipherData}`;
        let  date = el.end_date.split(' ')[0].split('/');
            newDate = new Date(`${date[0]}-${date[1]}-${date[2]}`),
            formatted_date =  `${months[newDate.getMonth()]} ${newDate.getDate()},${newDate.getFullYear()}`;

        $('div[id*=rightbar_event]').prepend(
          ` <div class="single-recent-post d-flex">
            <!-- Thumb -->
            <div class="post-thumb">
               <a href="${link}"><img src="./files/events/${el.image}" alt=""></a>
            </div>
            <!-- Content -->
            <div class="post-content">
               <!-- Post Meta -->
               <div class="post-meta">
                  <a href="${link}" class="post-author">${formatted_date}</a>
                  <a href="${link}" class="post-tutorial">${el.title}</a>
               </div>
               <a href="${link}" class="post-title">${el.title}</a>
            </div>
         </div>
            `
        );
      });
  });
});
